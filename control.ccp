<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<ImageLink id="2" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink1" wizardTheme="None" wizardThemeType="File" hrefSource="def_informe.ccp" visible="Yes" PathID="ImageLink1">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="3" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink2" wizardTheme="None" wizardThemeType="File" hrefSource="add_equipos.ccp" visible="Yes" PathID="ImageLink2">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="14" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink5" wizardTheme="None" wizardThemeType="File" hrefSource="add_secciones.ccp" visible="Yes" PathID="ImageLink5">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="15" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink6" wizardTheme="None" wizardThemeType="File" hrefSource="add_procedencias.ccp" visible="Yes" PathID="ImageLink6">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="4" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink3" wizardTheme="None" wizardThemeType="File" visible="Yes" PathID="ImageLink3">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<ImageLink id="5" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ImageLink4" wizardTheme="None" wizardThemeType="File" hrefSource="add_usuarios.ccp" visible="Yes" PathID="ImageLink4">
			<Components/>
			<Events/>
			<LinkParameters/>
			<Attributes/>
			<Features/>
		</ImageLink>
		<Grid id="6" secured="False" sourceType="Table" returnValueType="Number" name="informes" connection="Datos" dataSource="informes" pageSizeLimit="100" wizardCaption="Lista de Informes " wizardTheme="None" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" PathID="informes">
			<Components>
				<Link id="7" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" fieldSource="nom_informe" wizardCaption="Nom Informe" wizardTheme="None" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="def_grupos.ccp" visible="Yes" PathID="informesnom_informe">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="8" sourceType="DataField" name="s_informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<EditableGrid id="16" urlType="Relative" secured="True" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="configuracion" connection="Datos" dataSource="configuracion" wizardCaption="Lista de Configuracion " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" PathID="configuracion">
			<Components>
				<Sorter id="18" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="descripcion" PathID="configuracionSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_valor" column="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="valor" PathID="configuracionSorter_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="descripcion" fieldSource="descripcion" required="False" caption="Descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="clave" fieldSource="clave" required="False" caption="Clave" wizardCaption="Clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="23" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valor" fieldSource="valor" required="False" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="configuracionvalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="configuracionButton_Submit">
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
			<PKFields>
				<PKField id="17" tableName="configuracion" fieldName="configuracion_id" dataType="Integer"/>
			</PKFields>
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
			<SecurityGroups>
				<Group id="26" groupID="16" read="True"/>
				<Group id="27" groupID="17" read="True" insert="True" update="True" delete="True"/>
				<Group id="28" groupID="18" read="True" insert="True" update="True" delete="True"/>
				<Group id="29" groupID="19" read="True" insert="True" update="True" delete="True"/>
				<Group id="30" groupID="20" read="True" insert="True" update="True" delete="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="control.php" comment="//" codePage="utf-8" forShow="True" url="control.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="control_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="9" groupID="16"/>
		<Group id="10" groupID="17"/>
		<Group id="11" groupID="18"/>
		<Group id="12" groupID="19"/>
		<Group id="13" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="31"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
