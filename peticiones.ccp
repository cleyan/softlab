<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="26" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_pacientes_procSearch" wizardCaption="Buscar Peticiones, Pacientes, Procedencias, Estados " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="peticiones.ccp" PathID="peticiones_pacientes_procSearch">
			<Components>
				<TextBox id="28" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" visible="Yes" PathID="peticiones_pacientes_procSearchs_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticiones_procedencia_id" wizardCaption="Peticiones Procedencia Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="peticiones_pacientes_procSearchs_peticiones_procedencia_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_peticiones_estado_id" wizardCaption="Peticiones Estado Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" visible="Yes" PathID="peticiones_pacientes_procSearchs_peticiones_estado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="31" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="s_fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" visible="Yes" PathID="peticiones_pacientes_procSearchs_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="32" name="DatePicker_s_fecha" control="s_fecha" style="Themes/InLine/Style.css" wizardTheme="Inline" wizardThemeType="File" wizardSatellite="True" wizardControl="s_fecha" wizardDatePickerType="ImageLink" wizardPicture="Themes/DatePicker/DatePicker1.gif" PathID="peticiones_pacientes_procSearchDatePicker_s_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="27" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_pacientes_procSearchButton_DoSearch">
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
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_pacientes_proc" dataSource="peticiones, pacientes, procedencias, estados" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Pacientes, Procedencias, Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" PathID="peticiones_pacientes_proc">
			<Components>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_pacientes_proc_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="34"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="39" visible="True" name="Sorter_nom_estado" column="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_estado" PathID="peticiones_pacientes_procSorter_nom_estado">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="40" visible="True" name="Sorter_rut" column="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="rut" PathID="peticiones_pacientes_procSorter_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="41" visible="True" name="Sorter_ficha" column="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="ficha" PathID="peticiones_pacientes_procSorter_ficha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="42" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="peticiones_pacientes_procSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="43" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="peticiones_pacientes_procSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="44" visible="True" name="Sorter_peticion_id" column="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="peticion_id" PathID="peticiones_pacientes_procSorter_peticion_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="45" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="peticiones_pacientes_procSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="46" visible="True" name="Sorter_hora" column="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="hora" PathID="peticiones_pacientes_procSorter_hora">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="47" visible="True" name="Sorter_observaciones" column="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="observaciones" PathID="peticiones_pacientes_procSorter_observaciones">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="48" visible="True" name="Sorter_nom_procedencia" column="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_procedencia" PathID="peticiones_pacientes_procSorter_nom_procedencia">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="49" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="50" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="51" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="53" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="54" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="55" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="56" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="hora" fieldSource="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="57" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="observaciones" fieldSource="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="58" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="62" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="Alt_peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Alt_fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Alt_hora" fieldSource="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="67" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_observaciones" fieldSource="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="69" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="peticiones_pacientes_procNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="35" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="peticiones.procedencia_id" parameterSource="s_peticiones_procedencia_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="peticiones.estado_id" parameterSource="s_peticiones_estado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="3"/>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="3" tableName="peticiones" posWidth="171" posHeight="182" posLeft="10" posTop="10"/>
				<JoinTable id="11" tableName="pacientes" posWidth="145" posHeight="342" posLeft="271" posTop="13"/>
				<JoinTable id="17" tableName="procedencias" posWidth="142" posHeight="141" posLeft="276" posTop="375"/>
				<JoinTable id="20" tableName="estados" posWidth="131" posHeight="148" posLeft="95" posTop="276"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="23" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="24" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="25" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="4" tableName="peticiones" fieldName="peticion_id"/>
				<Field id="5" tableName="peticiones" alias="peticiones_paciente_id" fieldName="peticiones.paciente_id"/>
				<Field id="6" tableName="peticiones" alias="peticiones_procedencia_id" fieldName="peticiones.procedencia_id"/>
				<Field id="7" tableName="peticiones" alias="peticiones_estado_id" fieldName="peticiones.estado_id"/>
				<Field id="8" tableName="peticiones" fieldName="fecha"/>
				<Field id="9" tableName="peticiones" fieldName="hora"/>
				<Field id="10" tableName="peticiones" fieldName="observaciones"/>
				<Field id="12" tableName="pacientes" alias="pacientes_paciente_id" fieldName="pacientes.paciente_id"/>
				<Field id="13" tableName="pacientes" fieldName="rut"/>
				<Field id="14" tableName="pacientes" fieldName="ficha"/>
				<Field id="15" tableName="pacientes" fieldName="nombres"/>
				<Field id="16" tableName="pacientes" fieldName="apellidos"/>
				<Field id="18" tableName="procedencias" alias="procedencias_procedencia_id" fieldName="procedencias.procedencia_id"/>
				<Field id="19" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="21" tableName="estados" alias="estados_estado_id" fieldName="estados.estado_id"/>
				<Field id="22" tableName="estados" fieldName="nom_estado"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="peticiones_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="peticiones.php" comment="//" codePage="utf-8" forShow="True" url="peticiones.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="70"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
