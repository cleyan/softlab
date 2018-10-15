<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="13" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="informe_datosSearch" wizardCaption="Buscar Informe Datos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="del_Informes.ccp" PathID="informe_datosSearch">
			<Components>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" required="True" caption="Nº de petición" visible="Yes" PathID="informe_datosSearchs_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="14" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="informe_datosSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="Datos" name="informe_datos" dataSource="SELECT DISTINCT serie, peticion_id, informe_id, nombres, apellidos, fecha, firma_nombre, rut, ficha, nom_informe 
FROM informe_datos
WHERE peticion_id = {s_peticion_id}
ORDER BY serie, nom_informe" wizardCaption="Lista de Informe Datos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" wizardAllowSorting="True" PathID="informe_datos">
			<Components>
				<Link id="47" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="s_peticion_id" wizardTheme="Inline" wizardThemeType="File" hrefType="Page" urlType="Relative" preserveParameters="None" hrefSource="det_Peticion.ccp" visible="Yes" PathID="informe_datoss_peticion_id">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="57" sourceType="URL" name="peticion_id" source="s_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="37" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mmm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="23" visible="True" name="Sorter_serie" column="serie" wizardCaption="Serie" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="serie" PathID="informe_datosSorter_serie">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="49" visible="True" name="Informe" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="Simple" column="nom_informe" PathID="informe_datosInforme">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="29" visible="True" name="Sorter_firma_nombre" column="firma_nombre" wizardCaption="Firma Nombre" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="firma_nombre" PathID="informe_datosSorter_firma_nombre">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="48" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="del_Informes.ccp" visible="Yes" PathID="informe_datosImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="50" sourceType="DataField" name="peticion_id" source="peticion_id"/>
						<LinkParameter id="51" sourceType="DataField" name="informe_id" source="informe_id"/>
						<LinkParameter id="52" sourceType="DataField" name="serie" source="serie"/>
						<LinkParameter id="53" sourceType="URL" name="s_peticion_id" source="s_peticion_id"/>
						<LinkParameter id="59" sourceType="Expression" name="borrar" source="&quot;si&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="serie" fieldSource="serie" wizardCaption="Serie" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="46" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="firma_nombre" fieldSource="firma_nombre" wizardCaption="Firma Nombre" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="45"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="peticion_id" parameterSource="s_peticion_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
				<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="informe_datos" posWidth="162" posHeight="538" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="4" tableName="informe_datos" fieldName="serie"/>
				<Field id="5" tableName="informe_datos" fieldName="peticion_id"/>
				<Field id="6" tableName="informe_datos" fieldName="informe_id"/>
				<Field id="7" tableName="informe_datos" fieldName="nombres"/>
				<Field id="8" tableName="informe_datos" fieldName="apellidos"/>
				<Field id="9" tableName="informe_datos" fieldName="fecha"/>
				<Field id="10" tableName="informe_datos" fieldName="firma_nombre"/>
				<Field id="11" tableName="informe_datos" fieldName="rut"/>
				<Field id="12" tableName="informe_datos" fieldName="ficha"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="42" variable="s_peticion_id" parameterType="URL" dataType="Integer" parameterSource="s_peticion_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="del_Informes.php" comment="//" forShow="True" url="del_Informes.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="del_Informes_events.php" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="60" groupID="17"/>
		<Group id="61" groupID="18"/>
		<Group id="62" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="58"/>
			</Actions>
		</Event>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="63"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
